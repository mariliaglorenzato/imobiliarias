$(() => {
  $("#ST_CNPJ_PES").keydown(() => {
    try {
      $("#ST_CNPJ_PES").unmask();
    } catch (e) {}

    var size = $("#ST_CNPJ_PES").val().length;
    if (size < 11) {
      $("#ST_CNPJ_PES").mask("999.999.999-99");
    } else {
      $("#ST_CNPJ_PES").mask("99.999.999/9999-99");
    }

    // ajustando foco
    var elem = this;
    setTimeout(function () {
      // mudo a posição do seletor
      elem.selectionStart = elem.selectionEnd = 10000;
    }, 0);
    // reaplico o valor para mudar o foco
    var currentValue = $(this).val();
    $(this).val("");
    $(this).val(currentValue);
  });

  $("#occupant-save").on("click", () => {
    $.post(
      "/contratos/salvar",
      {
        ST_NOME_PES: $("#ST_NOME_PES").val(),
        ST_CNPJ_PES: $("#ST_CNPJ_PES").val(),
        ST_EMAIL_PES: $("#ST_EMAIL_PES").val(),
      },
      (response) => {}
    )
      .done((response) => {})
      .fail((response) => {});
  });
});
