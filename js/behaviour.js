(function () {
    document.addEventListener('DOMContentLoaded', () => {

        let notifications =  document.querySelector('header .notifications');
        notifications?.querySelector('button.bell')?.addEventListener('click', (() => {
            let info = notifications.querySelector('.info');
            info?.scroll(0, info.scrollHeight);
            info?.classList.toggle('opened');
        }));
        document.addEventListener('click', ((e) => {
            if (notifications && notifications.querySelector('.info').classList.contains('opened') &&
                (!e.target.closest('.notifications') || e.target.closest('button.close'))) {
                notifications.querySelector('.info').classList.remove('opened');
            }
        }));

        let search = document.querySelector('.menu .search');
        search?.querySelector('form button')?.addEventListener('click', ((e) => {
            e.preventDefault();
            let input = search.querySelector('input#search');
            if (input && !input.classList.contains('opened')) {
                input.classList.add('opened');
            } else if (input && input.classList.contains('opened') && input.value.length === 0) {
                input.classList.remove('opened');
            } else if (input && input.classList.contains('opened') && input.value.length > 0) {
                window.location.href = '../../search_result' + '?search=' + input.value;
            }
            document.addEventListener('click', ((e) => {
                if (input && input.classList.contains('opened') && !e.target.closest('.search')
                    && input.value.length === 0) {
                    input.classList.remove('opened');
                }
            }));
        }));

        let parent_menu_item = document.querySelector('.menu .tabs li.expanded');
        parent_menu_item?.addEventListener('mouseover', (() => {
            parent_menu_item.querySelector('.sublis').classList.add('opened');
        }));
        parent_menu_item?.addEventListener('mouseout', (() => {
            parent_menu_item.querySelector('.sublis').classList.remove('opened');
        }));

        let popup = document.querySelector('.popup');

        document.addEventListener('click', ((e) => {
            if (popup && popup.classList.contains('opened') && (!e.target.closest('.popup .info') &&
                !e.target.closest('.plan') &&
                !e.target.closest('button.change') || e.target.closest('.popup button.close'))) {
                popup.classList.remove('opened');
                popup.querySelector('.info .text').innerHTML = '';
            }
        }));

        let authreg = document.querySelector('.authreg form#authreg');
        authreg?.addEventListener('click', ((e) => {
           if (e.target.closest('.switch_authreg')) {
                e.preventDefault();
                if (e.target.closest('.switch_authreg').classList.contains('auth')) {
                    authreg.innerHTML = '    <input type="text" name="reg_login" placeholder="Your login*">\n' +
                        '                    <input type="password" name="reg_password" placeholder="Your password*">\n' +
                        '                    <input type="password" name="reg_password_1" placeholder="Your password again*">\n' +
                        '<div class="error"></div>\n' +
                        '                    <button id="send_authreg">\n' +
                        '                        <i class="fa fa-paper-plane" aria-hidden="true"></i>\n' +
                        '                        Register\n' +
                        '                    </button>\n' +
                        '                    <div class="switch_authreg reg">\n' +
                        '                        <a href="">Sign in</a>\n' +
                        '                    </div>';
                } else if (e.target.closest('.switch_authreg').classList.contains('reg')) {
                    authreg.innerHTML = '<input type="text" name="auth_login" placeholder="Your login*">\n' +
                        '                    <input type="password" name="auth_password" placeholder="Your password*">\n' +
                        '                    <div class="forgot_authreg">\n' +
                        '                        <a href="">Forgot password?</a>\n' +
                        '                    </div><div class="error"></div>\n' +
                        '                    <button id="send_authreg">\n' +
                        '                        <i class="fa fa-paper-plane" aria-hidden="true"></i>\n' +
                        '                        Log in\n' +
                        '                    </button>\n' +
                        '                    <div class="switch_authreg auth">\n' +
                        '                        <a href="">Sign up</a>\n' +
                        '                    </div>';
                }
           } else if (e.target.closest('.forgot_authreg')) {
               e.preventDefault();
               authreg.innerHTML = '<input type="text" name="forgot_login" placeholder="Your login*">\n' +
                   '<div class="error"></div>\n' +
                   '                    <button id="send_authreg">\n' +
                   '                        <i class="fa fa-paper-plane" aria-hidden="true"></i>\n' +
                   '                        Renew password\n' +
                   '                    </button>\n' +
                   '                    <div class="switch_authreg reg">\n' +
                   '                        <a href="">Back</a>\n' +
                   '                    </div>';
            }
        }));

        let authreg_popup = authreg?.closest('.authreg');
        document.addEventListener('click', ((e) => {
            if (authreg_popup && authreg_popup.classList.contains('opened') && (!e.target.closest('.authreg .info') && !e.target.closest('.switch_authreg') && !e.target.closest('.forgot_authreg') || e.target.closest('.authreg button.close')))
            {
                authreg.querySelector('.error').classList.remove('opened');
                authreg_popup.classList.remove('opened');
                authreg_popup.querySelectorAll('#authreg input').forEach(element => {
                    element.value = '';
                });

                if (window.location.href.indexOf('?restore=') > -1) {
                    window.location.href = window.location.href.substr(0,window.location.href.indexOf('?'));
                }
            }
        }));

        if (window.location.href.indexOf('?restore=') > -1) {
            if (document.cookie.indexOf('authorized=true') === -1) {
                let param = window.location.href.substr(window.location.href.indexOf('=')+1);
                authreg.innerHTML = '<input type="password" name="new_password" placeholder="Your new password*">\n' +
                    '<input type="text" name="param" hidden value='+param+'>\n' +
                    '<div class="error"></div>\n' +
                    '                    <button id="send_authreg">\n' +
                    '                        <i class="fa fa-paper-plane" aria-hidden="true"></i>\n' +
                    '                        Save password\n' +
                    '                    </button>\n';
                authreg_popup.classList.add('opened');
                authreg_popup.dataset.link = window.location.href;
            }
        }

//'Link to register friend: http://'.$_SERVER['HTTP_HOST'].'/main?invite='.$user[0]
        if (window.location.href.indexOf('?invite=') > -1) {
            if (document.cookie.indexOf('authorized=true') === -1) {
                //todo link active one time and link cipher
                let inviter = window.location.href.substr(window.location.href.indexOf('=')+1);
                authreg.innerHTML = '    <input type="text" name="reg_login" placeholder="Your login*">\n' +
                    '                    <input type="password" name="reg_password" placeholder="Your password*">\n' +
                    '                    <input type="password" name="reg_password_1" placeholder="Your password again*">\n' +
                    '<input type="text" name="inviter" hidden value='+inviter+'>\n' +
                    '<div class="error"></div>\n' +
                    '                    <button id="send_authreg">\n' +
                    '                        <i class="fa fa-paper-plane" aria-hidden="true"></i>\n' +
                    '                        Register by invitation\n' +
                    '                    </button>';
                authreg_popup.classList.add('opened');
                authreg_popup.dataset.link = window.location.href.substr(0,window.location.href.indexOf('?'));
            }
        }

        document.addEventListener('click', (e) => {
            if (e.target.closest('li[data-need-auth]')) {
                if (document.cookie.indexOf('authorized=true') === -1) {
                    e.preventDefault();
                    authreg_popup.classList.add('opened');
                    authreg_popup.dataset.link = e.target.href;
                }
            }
        });

        if (document.querySelector('.authentication')) {
            authreg_popup.classList.add('opened');
            authreg_popup.dataset.link = window.location.href;
        }

        document.querySelectorAll('.do_you_know .item').forEach(item => {
            item?.addEventListener('click', (e)=>{
                if (e.target.closest('.question')) {
                    item?.classList.toggle('opened');
                }
            });
        });

        document.querySelectorAll('.tags .tag').forEach(tag => {
            tag?.addEventListener('click', (e)=>{
                let text = tag.innerHTML;
                if (text.indexOf(',') > -1) {
                    text = text.substr(0,text.indexOf(','));
                }
                if (text.indexOf('<b>') > -1) {
                    text = text.substr(text.indexOf('<b>')+3, text.indexOf('</b>')-3);
                }
                window.location.href = '../../search_result?tag=' + text;
            });
        });

        document.querySelector(".post button.ar_button")?.addEventListener('click', (e) => {
            window.location.href = "/entertainments";
        });

        document.querySelector('.post_item .ar_label')?.addEventListener('click', ((e) => {
            e.target.nextElementSibling.classList.toggle('opened');
        }));

    });
})();