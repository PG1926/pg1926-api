const baseUrl = 'https://www.tasarlayici.net/pg1926-api/?';
const selectors = {
  loginForm: 'login-form',
  username: 'username',
  password: 'password',
  userInfo: 'user-info',
  name: 'name',
  surname: 'surname',
  registerDate: 'register-date'
};

function submitForm() {
  const username = document.getElementById(selectors.username).value;
  const password = document.getElementById(selectors.password).value;
  const requestUrl = baseUrl + 'kullanici=' + username + '&parola=' + password;

  $.ajax({
    url: requestUrl,
    async: false,
    dataType: 'json',
    success: function (response) {
      if (response.durum) {
        updateUserInfo(response.kullanici);
        updatePage();
      }
      else {
        alert('Kullanıcı Adı ya da Parola Hatalı!');
      }
    }
  });
};

function updateUserInfo(userInfo) {
  document.getElementById(selectors.name).innerHTML = 'İsim: ' + userInfo.isim;
  document.getElementById(selectors.surname).innerHTML = 'Soyisim: ' + userInfo.soyisim;
  document.getElementById(selectors.registerDate).innerHTML = 'Kayıt Tarihi: ' + userInfo.kayitTarihi;
};

function updatePage() {
  document.getElementById(selectors.loginForm).classList.toggle("invisible");
  document.getElementById(selectors.userInfo).classList.toggle("invisible");
};