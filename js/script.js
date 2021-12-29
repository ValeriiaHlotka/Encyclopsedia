document.addEventListener("DOMContentLoaded",function() {
    function PrepareRequest(path = "/app/models/ajax.php") {
        const request = new XMLHttpRequest();
        const url = path;
        request.responseType = "json";
        request.open("POST", url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        return request;
    }

    function ShowPopup(data) {
        let popup = document.querySelector('.popup');
        popup.classList.add('opened');
        popup.querySelector('.info .text').innerHTML = data;
    }

    function HidePopup() {
        let popup = document.querySelector('.popup');
        popup.classList.remove('opened');
        popup.querySelector('.info .text').innerHTML = '';
        HideError(popup);
    }

    function ShowError(parent, data) {
        let block = parent.querySelector('.error');
        if (block) {
            block.innerHTML = data;
            block.classList.add('opened');
        }
    }

    function HideError(parent) {
        let block = parent.querySelector('.error');
        if (block) {
            block.classList.remove('opened');
            block.innerHTML = '';
        }
    }

    let feedback_form = document.querySelector('#feedback');
    let feedback_btn = feedback_form?.querySelector('#send_feedback');
    feedback_btn?.addEventListener('click', (e)=>{
        e.preventDefault();
        let params = '';
        feedback_form.querySelectorAll('input').forEach(field => {
            params += field.name + '=' + field.value + '&';
        });
        let textarea = feedback_form.querySelector("textarea");
        params = params + textarea.name + '=' + textarea.value;

        let request = PrepareRequest();
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                if (request.response.status === 'success') {
                    ShowPopup('Sent successfully!');
                } else {
                    ShowPopup('Something went wrong, please, try later');
                }
            }
        });
        request.send(params);
    });

    let plans = document.querySelector('.subscription section.plans');
    plans?.addEventListener('click', (e) => {
        if (e.target.closest('.plan')) {
            let plan = e.target.closest('.plan');
            let heading = plan.querySelector('.heading');
            let price = plan.querySelector('.price');
            let data = '<div class="confirm_text">';
            data += 'You have chosen plan "'+heading.innerHTML+'",<br>payment sum: '+price.innerHTML+'</div>';
            data += '<button id="confirm_payment"><i class="fa fa-shopping-cart"></i> Buy</button>'
            ShowPopup(data);
        }
    });

    let authreg = document.querySelector('.authreg');
    let authreg_form = authreg?.querySelector('#authreg');
    authreg_form?.addEventListener('click', (e)=>{
        if (e.target.closest('#authreg #send_authreg')) {
            e.preventDefault();
            let pass = authreg_form.querySelector('input[name=reg_password]')?.value;
            let pass1 = authreg_form.querySelector('input[name=reg_password_1]')?.value;
            if (pass && pass1 && (pass !== pass1)) {
                ShowError(authreg_form, 'Passwords are not the same, check and try again');
            }
            let params = '';
            authreg_form.querySelectorAll('input').forEach(field => {
                params += field.name + '=' + field.value + '&';
            });
            params = params.substr(0,params.length-1);
            let request = PrepareRequest();
            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    if (request.response.status === 'auth success' || request.response.status === 'reg success' || request.response.status === 'renew success') {
                        HideError(authreg_form);
                        authreg.classList.remove('opened');
                        window.location.href = authreg.dataset.link;
                        document.cookie = 'authorized=true';
                    } else if (request.response.status === 'wrong password'){
                        ShowError(authreg_form, 'Wrong login or password, try again');
                    } else if (request.response.status === 'no login'){
                        ShowError(authreg_form, 'There is no such a login, try again');
                    } else if (request.response.status === 'reg failure'){
                        ShowError(authreg_form, 'Registration failed, try later');
                    } else if (request.response.status === 'login exists'){
                        ShowError(authreg_form, 'There is such a login, enter different one');
                    } else if (request.response.status === 'sending failure'){
                        ShowError(authreg_form, 'Something went wrong, try later');
                    } else if (request.response.status === 'sent'){
                        ShowError(authreg_form, 'Email with a restore link is sent to '+request.response.mail);
                    } else if (request.response.status === 'renew error' || request.response.status === 'no user'){
                        ShowError(authreg_form, 'Password renew failure, try later');
                    }
                }
            });
            request.send(params);
        }
    });

    let profile = document.querySelector('.profile .content_area');
    profile?.addEventListener('click', (e) => {
       if (e.target.closest('button.change')) {
           let action = e.target.closest('button.change').id;
           let subject, type;
           switch (action) {
               case 'change_login':
                   subject = 'nickname';
                   type = 'text';
                   break;
               case 'change_password':
                   subject = 'password';
                   type = 'password';
                   break;
               case 'change_time':
                   subject = 'active time';
                   type = 'text';
                   break;
               case 'change_email':
                   subject = 'email';
                   type = 'email';
                   break;
           }
           let data = '<div class="confirm_text">Enter new '+subject+'</div>';
           data += '<form id="profile"><input name="'+action+'" type="'+type+'"><div class="error"></div>';
           data += '<button id="update_profile"><i class="fa fa-save"></i> Save</button></form>';
           ShowPopup(data);
       }
    });

    document.addEventListener('click', (e) => {
        if (e.target.closest('#update_profile')) {
            let profile_form = document.querySelector('.popup .text form#profile');
            e.preventDefault();
            let params = '';
            let input = profile_form.querySelector('input');
                params += input.name + '=' + input.value;

            let request = PrepareRequest();
            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    if (request.response.status === 'success') {
                        ShowError(profile_form, 'Updated successfully!');
                        setTimeout(HidePopup, 2000);
                        window.location.reload();
                    } else if (request.response.status === 'failure') {
                        ShowError(profile_form, 'Updating error, try later');
                    }
                }});
            request.send(params);
        }
    });

    document.getElementById('log_out')?.addEventListener('click', (e)=>{
        document.cookie = 'authorized=false';
        let params = 'action=log_out';
        let request = PrepareRequest();
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                if (request.response.status === 'success') {
                    window.location.href = window.location.href.substr(0,window.location.href.indexOf('/',7));
                }
            }});
        request.send(params);
    });

    document.querySelectorAll('.test .answer')?.forEach(item => {
        item.addEventListener('click', (e)=>{
            if (item.innerHTML.indexOf('i class="fa fa-') === -1 && !item.parentElement.parentElement.querySelector('.error.opened') && !item.closest('.test.expired')) {
                let test = item.closest('.test');
                let question = test.querySelector('.question');

                let params;
                if ('id' in test.dataset) {
                    params = 'test=' + test?.dataset.id + '&answer=' + item.dataset.id;
                } else if ('id' in question.dataset) {
                    params = 'question=' + question?.dataset.id + '&answer=' + item.dataset.id;
                }
                let timer = item.parentElement.parentElement.querySelector('.timer');
                timer?.remove();
                let request = PrepareRequest();
                request.addEventListener("readystatechange", () => {
                    if (request.readyState === 4 && request.status === 200) {
                        //item.parentElement.classList.add('opened');
                        let timer = item.parentElement.querySelector('.timer');
                        if (request.response.status === 'true') {
                            item.innerHTML = '<b>'+item.innerHTML+'</b>';
                            item.innerHTML += ' <i class="fa fa-check"></i>';
                            item.parentElement.childNodes.forEach(sibling => {
                                if (sibling.innerHTML.indexOf('i class="fa fa-') === -1) {
                                    sibling.innerHTML += ' <i class="fa fa-times"></i>';
                                }
                            });
                        } else if (request.response.status === 'false') {
                            item.innerHTML = '<b>'+item.innerHTML+'</b>';
                            let correct = item.parentElement.querySelector('.answer[data-id="'+request.response.correct+'"]');
                            correct.innerHTML += ' <i class="fa fa-check"></i>';
                            item.parentElement.childNodes.forEach(sibling => {
                                if (sibling.innerHTML.indexOf('i class="fa fa-') === -1) {
                                    sibling.innerHTML += ' <i class="fa fa-times"></i>';
                                }
                            });
                        } else if (request.response.status === 'you already') {
                            ShowError(item.parentElement.parentElement, 'No, you have already answered this question');
                        }
                    }
                });
                request.send(params);
            }
        });
    });

    document.querySelectorAll('.post button.like').forEach(like => {
        like.addEventListener('click', (e)=>{
            let post_id = like.closest('.post')?.querySelector('.heading').dataset.id;
            let params;
            if (like.classList.contains('chosen')) {
                params = 'action=remove_favourite&post='+post_id;
            } else {
                params = 'action=add_favourite&post='+post_id;
            }

            let request = PrepareRequest();
            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    if (request.response.status === 'add success') {
                        like.classList.add('chosen');
                    } else if (request.response.status === 'remove success') {
                        like.classList.remove('chosen');
                    }
                }
            });
            request.send(params);
        });
    });

    if (window.location.href.indexOf('/post/item/') > -1) {
        let post = document.querySelector('.post_item .post')?.dataset.id;
        let params = 'action=add_viewing&post='+post;
        let request = PrepareRequest();
        let id;
        let is_got = false;
        request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                if (request.response.status === 'success') {
                    id = request.response.id;
                }
                if (request.response.is_got) {
                    is_got = request.response.is_got;
                    confirm.closest('.post_item')?.querySelector('.content_area')?.classList.add('opened');
                    confirm.classList.add('chosen');
                }
            }
        });
        request.send(params);

        let confirm = document.querySelector('.post_item button.confirm');
        confirm?.addEventListener('click', (e)=>{
//got it! click
            if (!is_got) {
                confirm.closest('.post_item')?.querySelector('.content_area')?.classList.add('opened');
                let params = 'action=edit_viewing&id=' + id;
                let request = PrepareRequest();
                request.send(params);
            } else {
                ShowError(confirm.parentElement, 'you have already got it');
            }
        });
    }

//timer
    function ShowCounter(timer, time_string = "2021-12-1 15:37:25", active = null) {
        let countDownDate = new Date(time_string).getTime();
        let x = setInterval(function () {
            let distance;
            let now = new Date().getTime();
                if (active === null)
                    distance = countDownDate - now;
                else {
                    distance = countDownDate + active * 60 * 60 * 1000 - now;
                }
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                timer.classList.add('opened');
                timer.parentElement.querySelector('.timer_label')?.classList.add('opened');
                timer.innerHTML = days + "d " + hours + "h "
                    + minutes + "m";
                if (active !== null)
                    timer.innerHTML += " " + seconds + "s";
                if (distance < 0) {
                    clearInterval(x);
                    timer.innerHTML = "0d 0h 0m 0s";
                    let test = timer.closest('.test');
                    if (test) {
                        test.classList.add('expired');
                        let params = 'action=edit_test&test=' + test.dataset.id;
                        let request = PrepareRequest();
                        request.send(params);
                    } else {
                        let params = 'action=get_next_test';
                        let request = PrepareRequest();
                        request.addEventListener("readystatechange", () => {
                            if (request.readyState === 4 && request.status === 200) {
                                ShowCounter(timer, request.response.next);
                                let text = timer.parentElement.querySelector('.text');
                                text.innerHTML = request.response.test;
                            }
                        });
                        request.send(params);
                    }
                }
        }, 1000);
    }
//end timer

    document.querySelectorAll('.timer').forEach(timer=>{
        if ('date' in timer.parentElement.dataset && !timer.classList.contains('opened')) {
            ShowCounter(timer, timer.parentElement.dataset.date, 3);
        }
        else if (timer.parentElement.classList.contains('info') && (timer.innerHTML === "0d 0h 0m 0s" || timer.innerHTML === '')) {
            let params = 'action=get_next_test';
            let request = PrepareRequest();
            request.addEventListener("readystatechange", () => {
                if (request.readyState === 4 && request.status === 200) {
                    if (request.response != null && 'next' in request.response)
                        ShowCounter(timer, request.response.next);
                }
            });
            request.send(params);
        }
    });




});