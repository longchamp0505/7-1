document.addEventListener('DOMContentLoaded', function () {
    const adminRadio = document.querySelector('input[name="role"][value="0"]');
    const userRadio = document.querySelector('input[name="role"][value="1"]');
    const countrySelect = document.getElementById('registration_country_select');
    const registerForm = document.querySelector('form');

    // 管理者選択で所属国を無効化
    adminRadio.addEventListener('change', function () {
        if (adminRadio.checked) {
            countrySelect.disabled = true;
        }
    });

    // 一般ユーザー選択で所属国を有効化
    userRadio.addEventListener('change', function () {
        if (userRadio.checked) {
            countrySelect.disabled = false;
        }
    });

    // 登録ボタンクリック時に確認ダイアログ
    registerForm.addEventListener('submit', function (e) {
        if (!confirm('この情報でユーザー登録を行いますか？')) {
            e.preventDefault(); // キャンセルされた場合は送信しない
        }
    });
});
