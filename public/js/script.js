$(function () {
    'use strict';
    $('body').on('click', '.saveHash', function (e) {
        e.preventDefault();
        var submitId = $(this).attr('id');
        var dataAlgorithm = $("."+submitId+"-algorithm").text();
        var dataHash = $("."+submitId+"-hash").text();

        $.ajax({
            url: "/hash",
            method: "post",
            dataType: "json",
            data: {
                word_id: submitId,
                algorithm: dataAlgorithm,
                hash: dataHash,
                _token: window.Laravel.csrfToken
            },
            success: function (response) {
                $('#'+submitId).addClass('disabled'); // Disables visually
                alert('Saved to your accaunt');
            }
        })
    })
});