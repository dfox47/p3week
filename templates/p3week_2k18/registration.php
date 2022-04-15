
<div class="wrap">
	<form class="reg_form">
		<!-- step 1 -->
		<div class="reg_step active js-reg-step" data-step="1">
			<!-- Категории -->
			<label class="reg_form__label">
				<span class="reg_form__title">Выберите категорию:</span>

				<select class="js-reg-category" name="category">
					<option value="type1" data-price="23900" data-days="any" data-category="standard">Стандарт</option>
					<option value="type2" data-price="40900" data-days="any" data-category="business">Бизнес</option>
					<option value="type3" data-price="57900" data-days="any" data-category="premium">Премиум</option>
					<option value="type4" data-price="98900" data-days="vip" data-category="vip">VIP</option>
					<option value="type5" data-price="0" data-days="business" data-category="government">Органы власти</option>
					<option value="type6" data-price="40900" data-days="business" data-category="budget_org">Бюджетные организации</option>
					<option value="type7" data-price="0" data-days="business" data-category="media">СМИ</option>
				</select>
			</label>

			<!-- Дни -->
			<div class="reg_special_block js-reg-show-at-category" data-category="standard business premium">
				<div class="reg_form__label">
					<div class="reg_form__title">Выберите, какие дни вы планируете посетить:</div>

					<label class="reg_form_checkbox">
						<input class="js-reg-day" type="checkbox" name="day1" />
						<span class="reg_form_checkbox__box"></span>
						<span class="reg_form_checkbox__title">12 сентября</span>
					</label>

					<label class="reg_form_checkbox">
						<input class="js-reg-day" type="checkbox" name="day2" />
						<span class="reg_form_checkbox__box"></span>
						<span class="reg_form_checkbox__title">13 сентября</span>
					</label>

					<label class="reg_form_checkbox">
						<input class="js-reg-day" type="checkbox" name="day3" />
						<span class="reg_form_checkbox__box"></span>
						<span class="reg_form_checkbox__title">14 сентября</span>
					</label>
				</div>

				<div class="reg_form__label">
					<div class="reg_form__title"></div>

					<div class="reg_category_desc">
						<div class="reg_special_block js-reg-show-at-category" data-category="standard">Только один день на выбор 12-14 сентября</div>
						<div class="reg_special_block js-reg-show-at-category" data-category="business">Любые два дня на выбор 12-14 сентября</div>
						<div class="reg_special_block js-reg-show-at-category" data-category="premium">12-14 сентября</div>
						<div class="reg_special_block js-reg-show-at-category" data-category="vip">12-15 сентября</div>
					</div>
				</div>
			</div>

			<div class="reg_special_block js-reg-show-at-category" data-category="government budget_org media">
				<div class="reg_form__label">
					<div class="reg_form__title">Доступные дни:</div>
					<div>Только деловая программа</div>
				</div>
			</div>

			<div class="reg_special_block js-reg-show-at-category" data-category="vip">
				<div class="reg_form__label">
					<div class="reg_form__title">Доступные дни:</div>
					<div>4 дня + доп.опции</div>
				</div>
			</div>

			<div class="reg_buttons">
				<button class="reg_btn js-reg-step-show" data-step="2">Продолжить</button>
			</div>
		</div>

		<!-- step 2 -->
		<div class="reg_step js-reg-step" data-step="2">
			<h2>Персональные данные</h2>

			<label class="reg_form__label">
				<span class="reg_form__title">Фамилия</span>
				<input type="text" name="reg_name2" />
			</label>

			<label class="reg_form__label">
				<span class="reg_form__title">Имя</span>
				<input type="text" name="reg_name" />
			</label>

			<label class="reg_form__label">
				<span class="reg_form__title">Отчество</span>
				<input type="text" name="reg_name3" />
			</label>

			<label class="reg_form__label">
				<span class="reg_form__title">серия/номер паспорта</span>
				<input type="text" name="reg_passport" />
			</label>

			<label class="reg_form__label">
				<span class="reg_form__title">телефон</span>
				<input type="text" name="reg_phone" />
			</label>

			<label class="reg_form__label">
				<span class="reg_form__title">почта</span>
				<input type="text" name="reg_email" />
			</label>

			<label class="reg_form__label">
				<span class="reg_form__title">должность</span>
				<input type="text" name="reg_status" />
			</label>

			<div class="reg_special_block js-reg-show-at-category" data-category="standard business premium vip budget_org">
				<h2>Реквизиты</h2>

				<label class="reg_form__label">
					<span class="reg_form__title">Наименование организации</span>
					<input type="text" name="reg_org_name" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">Адрес организации</span>
					<input type="text" name="reg_org_address" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">ИНН</span>
					<input type="text" name="reg_inn" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">КПП</span>
					<input type="text" name="reg_kpp" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">ОГРН</span>
					<input type="text" name="reg_ogrn" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">р/с</span>
					<input type="text" name="reg_rs" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">Наименование банка</span>
					<input type="text" name="reg_bank_name" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">БИК</span>
					<input type="text" name="reg_bik" />
				</label>

				<label class="reg_form__label">
					<span class="reg_form__title">к/с</span>
					<input type="text" name="reg_ks" />
				</label>
			</div>

			<div class="reg_special_block js-reg-show-at-category" data-category="standard business premium government budget_org media">
				<div class="reg_form__label">
					<div class="reg_form__title">Хотите добавить к вашему тарифу посещение образовательного дня?</div>

					<label class="reg_form_checkbox">
						<input class="js-reg-education-day" type="checkbox" name="reg_edu_day" data-price="27900" />
						<span class="reg_form_checkbox__box"></span>
						<span class="reg_form_checkbox__title">Да</span>
					</label>
				</div>
			</div>

			<div class="reg_buttons">
				<button class="reg_btn js-reg-step-show" data-step="1">Назад</button>
				<button class="reg_btn js-reg-create-bill">сформировать счет</button>
			</div>
		</div>

		<div class="reg_total">
			<div class="reg_total__title">Стоимость</div>
			<div class="reg_total__price">
				<span class="js-reg-price">0</span>&nbsp;руб.
			</div>
		</div>
	</form>

	<div class="popup js-popup">
		<div class="popup__content">
			<div class="popup_close js-popup-close"></div>

			<p>
				Благодарим Вас за регистрацию, Ваша заявка ожидает подтверждения.
			</p>

			<p>
				Вся информация будет направлена на указанный электронный адрес.
			</p>

			<p>
				Для уточнения информации Вы можете обратиться по тел или почте:<br />
				<a class="phone" href="javascript:void(0);">+7 (495) 988-77-13</a> / <a href="mailto:info@p3week.ru">info@p3week.ru</a>
			</p>
		</div>
	</div>
</div>
