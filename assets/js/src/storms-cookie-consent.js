"use strict";

/* global storms_cookie_consent_vars */
const cookieConsentCookieStorage = {
	getItem: (item) => {
		const cookies = document.cookie
			.split(';')
			.map(cookie => cookie.split('='))
			.reduce((acc, [key, value]) => ({ ...acc, [key.trim()]: value }), {});
		return cookies[item];
	},
	setItem: (item, value) => {
		document.cookie = `${item}=${value};path=/;`
	}
};

const cookieConsentStorageType = cookieConsentCookieStorage;
const cookieConsentPropertyName = 'storms_cookie_consent_accepted';
const shouldShowCookieConsentPopup = () => ! cookieConsentStorageType.getItem(cookieConsentPropertyName);
const saveCookieConsentToStorage = () => cookieConsentStorageType.setItem(cookieConsentPropertyName, true);

window.onload = () => {

	// storms_cookie_consent_vars is required to continue, ensure the object exists
	if ( typeof storms_cookie_consent_vars === 'undefined' ) {
		return false;
	}

	const acceptFn = event => {
		saveCookieConsentToStorage(cookieConsentStorageType);
		consentPopup.classList.add('hidden');
		event.preventDefault();
	};
	const consentPopup = document.getElementById( storms_cookie_consent_vars.modal_id );
	const acceptBtn = document.getElementById( storms_cookie_consent_vars.accept_btn_id );
	acceptBtn.addEventListener('click', acceptFn);

	if (shouldShowCookieConsentPopup(cookieConsentStorageType)) {
		setTimeout(() => {
			consentPopup.classList.remove('hidden');
		}, 2000);
	}

};
