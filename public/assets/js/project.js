const req = $('input[required], select[required]')
const form = $('form')

if (req.length) {
    req.parent().find('label').append('<span class="text-danger ms-1">*</span>')
    $('* div.form-group:last').after('<div class="mb-4 w-100 text-muted"><span class="text-danger ms-1">*</span>) Wajib diisi</div>')
}

if (form) {
    form.attr('autocomplete', 'off')
}

$('#dataTable>thead>tr>th:contains("ID"), #dataTable>thead>tr>th:contains("NPM")').attr('width', "1%")
$('button[class*="btn-danger"]:submit:contains("Hapus")').attr('onclick', "return confirm('Yakin akan menghapus data ini?')")
$('button[class*="btn"]:submit').on('click', function () {
    $(this).attr("disabled", "disabled").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
})

$(document).ready(function () {
    $(document).ready(function () {
        $('#loadingSpinner').fadeOut(300, function () { $(this).remove(); })
    })
})

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})