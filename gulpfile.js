
let concat              = require('gulp-concat')
let config              = JSON.parse(fs.readFileSync('../config.json'))
let cssMinify           = require('gulp-csso')
let ftp                 = require('vinyl-ftp')
let gulp                = require('gulp')
let gutil               = require('gulp-util')
let rename              = require('gulp-rename')
let sass                = require('gulp-sass')(require('sass'))
let uglify              = require('gulp-uglify')

// FTP config
let host                = config.host
let password            = config.password
let port                = config.port
let user                = config.user

let remoteFolder        = '/www/p3week.ru/templates/p3week_2k18/'
let remoteFolderCss     = remoteFolder + 'css/'
let remoteFolderJs      = remoteFolder + 'js/'
let remoteFolderLang    = '/www/p3week.ru/language/overrides/'

let localFolder         = 'www/templates/p3week_2k18/'
let localFolderCss      = localFolder + 'css/'
let localFolderJs       = localFolder + 'js/'
let localFolderLang     = 'www/language/overrides/'



function getFtpConnection() {
	return ftp.create({
		host:           host,
		log:            gutil.log,
		password:       password,
		parallel:       3,
		port:           port,
		user:           user
	})
}

let conn = getFtpConnection()



gulp.task('css', function () {
	return gulp.src(localFolderCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder))
})

gulp.task('copy_css', function () {
	return gulp.src(localFolderCss + '**/*')
		.pipe(conn.dest(remoteFolderCss))
})

gulp.task('copy_html', function () {
	return gulp.src(localFolder + '*.php')
		.pipe(conn.dest(remoteFolder))
})

gulp.task('copy_js', function () {
	return gulp.src(localFolderJs + '**/*.js')
		.pipe(conn.dest(remoteFolderJs))
})

gulp.task('lang', function () {
	return gulp.src(localFolderLang + '*.ini')
		.pipe(conn.dest(remoteFolderLang))
})

gulp.task('js', function () {
	return gulp.src([
			// localFolderJs + 'jquery.3.2.1.js',
			localFolderJs + 'owl.carousel.js',
			localFolderJs + 'html2pdf.bundle.min.js',
			localFolderJs + '**/*.js'
		])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder))
})

gulp.task('watch', function() {
	gulp.watch(localFolderCss + '**/*',         gulp.series('css', 'copy_css'))
	gulp.watch(localFolder + '*.php',           gulp.series('copy_html'))
	gulp.watch(localFolderLang + '*.ini',       gulp.series('lang'))
	gulp.watch(localFolderJs + '**/*.js',       gulp.series('js', 'copy_js'))
})

gulp.task('default', gulp.series(
	'watch'
))
