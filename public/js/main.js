$(() => {
  /**
   * Tables Renderers
   */
  var myTable = $("#dataTable").DataTable({
    serverSide: true,
    processing: true,
    paging: true,
    pageLength: 50,
    ajax: {
      url: "/contratos/listar",
      type: "GET",
      data: myTable == null ? { start: 0, length: 10 } : myTable.page.info(),
    },
    columns: [
      { data: "acesso_geral" },
      { data: "codigo_contrato" },
      { data: "nome_proprietario" },
    ],
  });
});
