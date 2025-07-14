document.addEventListener('DOMContentLoaded', function () {
    const adminRadio = document.querySelector('input[name="role"][value="0"]');
    const userRadio = document.querySelector('input[name="role"][value="1"]');
    const countrySelect = document.getElementById('registration_country_select');
    const registerForm = document.querySelector('form');

    adminRadio.addEventListener('change', function () {
        if (adminRadio.checked) {
            countrySelect.value = "";     // valueを空にして
            countrySelect.setAttribute('disabled', 'disabled');
        }
    });
    userRadio.addEventListener('change', function () {
        if (userRadio.checked) {
            countrySelect.removeAttribute('disabled');
        }
    });


    // 登録ボタンクリック時に確認ダイアログ
    registerForm.addEventListener('submit', function (e) {
        if (!confirm('この情報でユーザー登録を行いますか？')) {
            e.preventDefault(); // キャンセルされた場合は送信しない
        }
    });
});
