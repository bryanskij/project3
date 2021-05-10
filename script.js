var s = {
    v:{

    },
    e:{
        'init': function(){
            $('#request').click(function(){
                var email = $('#email').val();
                if(email && s.f.validateEmail(email)){
                    s.f.request();
                } else {
                    alert('Введите корректный Email!');
                }
            });
        }
    },
    f:{
        request: function(){
            $.ajax({
                url: '/request',
                data: {
                    email: $('#email').val()
                },
                type: 'POST',
                async: true,
                dataType: 'json'
            }).done(function (data) {
                if (data.status == 3) {
                    $('#result').text('Это не Email!').attr('class', 'bad');
                } else if (data.status == 2) {
                    $('#result').text(data.text).attr('class', 'good');
                } else {
                    alert('Произошла ошибка! Обновите страницу и попробуйте снова!');
                }
            }).fail(function(){
                alert('Произошла ошибка! Обновите страницу и попробуйте снова!');
            });
        },
        validateEmail: function (email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test(email);
        }
    },
    load_events: function (o, e) {
        if (typeof e == 'object' && e.length > 0) {
            for (var i in e) {
                if (typeof eval(o).e[e[i]] == 'function') {
                    eval(o).e[e[i]]();
                }
            }
        }
    }
}

$(function () {
    s.load_events('s', ['init']);
});
