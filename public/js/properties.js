$(document).ready(() => {
  $("#ST_CEP_IMO").keydown(() => {
    $("#ST_CEP_IMO").mask("99999-999");
  });

  $("#occupant-save").on("click", () => {
    $.post(
      "/locatarios/salvar",
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

  $("#occupant-update").on("click", () => {
    $("occupant-update").off("click");
    $.post(
      "/locatarios/atualizar",
      {
        ID_PESSOA_PES: sessionStorage.getItem("occupant-id"),
        ST_NOME_PES: $("#ST_NOME_PES").val(),
        ST_CNPJ_PES: $("#ST_CNPJ_PES").val(),
        ST_EMAIL_PES: $("#ST_EMAIL_PES").val(),
      },
      (response) => {}
    )
      .done((response) => {
        alert("sucesso"); //implementar system dialog
        window.location.href = "/locatarios";
      })
      .fail((response) => {});
  });
});
