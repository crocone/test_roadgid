$(function () {
    $('form#shortMyLinkForm').submit(function (e) {
        e.preventDefault();
        const successBlock = $(".resultSuccess")
        const errorBlock = $(".resultError")
        successBlock.bsHide();
        errorBlock.bsHide();
        const data = $('form#shortMyLinkForm').serialize();
        $.ajax({
            url: 'http://localhost:8000/api/generate',
            type: 'get',
            dataType: 'json',
            data,
            success: function (data) {
                if (data.result === 'success') {
                    $(".shortLinkResult").val(data.url)
                    successBlock.bsShow();
                } else {
                    errorBlock.text(data.message).bsShow();
                }
            },
            error: function () {

            }
        });
        return false;
    })

    $('.copyLink').on('click', () => {
        if (!navigator.clipboard) {
            $('.shortLinkResult').select()
            document.execCommand("copy");
            alert("Ссылка успешно скопирована!");
        } else {
            const linkToCopy = $('.shortLinkResult').val()
            navigator.clipboard.writeText(linkToCopy).then(
                function () {
                    alert("Ссылка успешно скопирована!"); // success
                })
                .catch(
                    function () {
                        alert("Произошла ошибка"); // error
                    });
        }

    })

    $.fn.bsShow = function () {
        $(this).removeClass('d-none');
    }
    $.fn.bsHide = function () {
        $(this).addClass('d-none');
    }

})
