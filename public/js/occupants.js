$(() => {
  /**
   * Tables Renderers
   */
  var myTable = $("#dataTable").DataTable({
    serverSide: true,
    processing: true,
    paging: true,
    pageLength: 50,
    rowId: "id_pessoa_pes",
    ajax: {
      url: "/locatarios/listar",
      type: "GET",
      data: myTable == null ? { start: 0, length: 10 } : myTable.page.info(),
    },
    columns: [
      { data: "st_nome_pes" },
      { data: "st_cnpj_pes" },
      { data: "st_email_pes" },
      {
        defaultContent:
          '<button class="edit btn btn-success" type="button">Editar</button>',
      },
    ],
  });

  $(document).on("click", "#dataTable button.edit", (e) => {
    var id = $(e.target).parent().closest("tr").attr("id");
    sessionStorage.setItem("occupant-id", id);
    sessionStorage.setItem(
      "ST_NOME_PES",
      $(e.target).closest("tr").find("td:first-child").html()
    );
    sessionStorage.setItem(
      "ST_CNPJ_PES",
      $(e.target).closest("tr").find("td:nth-child(2)").html()
    );
    sessionStorage.setItem(
      "ST_EMAIL_PES",
      $(e.target).closest("tr").find("td:nth-child(3)").html()
    );
    window.location.href = "/locatarios/editar/" + id;
  });

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

  /**
   * Edit Occupants
   */
  if (sessionStorage.getItem("occupant-id") !== null) {
    $("#edit-occupant input#ST_NOME_PES").val(
      sessionStorage.getItem("ST_NOME_PES")
    );
    $("#edit-occupant input#ST_CNPJ_PES").val(
      sessionStorage.getItem("ST_CNPJ_PES")
    );
    $("#edit-occupant input#ST_EMAIL_PES").val(
      sessionStorage.getItem("ST_EMAIL_PES")
    );
  }
});
