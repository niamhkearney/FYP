
var apisubject = ' {{ Session::get("subject") }}';
var apicategory = ' {{ Session::get("category") }}';

var getpicture = 'https://pixabay.com/api/?key=33669290-6e1b0c759f42b1ad905af4988&q=' + apisubject + apicategory + 'image_type=photo&safesearch=true&per_page=5';


var settings = {
    "url": getpicture,
    "method": "GET",
    "timeout": 0,
    "headers": {
        "Cookie": "anonymous_user_id=None; csrftoken=gIEylq4vXwzwrjNVpbnk37m2pAky9mVu2gWvMLOMDlvU2SzymCX662oBVKWY2TDV; g_rated=permanent"
    },
};

$.ajax(settings).done(function (response) {
    console.log(response);
});
