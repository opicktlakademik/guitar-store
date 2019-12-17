$('#btn-bantu').click(() => {
    var alternatives = new Array();
    $("input:checked").each(function () {
        alternatives.push($(this).val());
    });

    if (alternatives.length > 1) {
        window.location.href = window.location.pathname +"/pilih?hmmm=" + alternatives;
    } else if(alternatives.length == 1) {
        myAlert("Pilihannya kan cuma satu yaudah itu aja, ya...", true);
    } else {
        myAlert("Silahkan pilih terlebih dahulu gitarnya, ya..", false);
    }
})