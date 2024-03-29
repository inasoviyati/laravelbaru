const req = $('input[required], select[required], textarea[required]')
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
    $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
})

$(document).ready(function () {
    $(document).ready(function () {
        $('#loadingSpinner').fadeOut(300, function () { $(this).remove(); $('body').removeAttr('class') })
    })
})

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

$(document).ready(function () {
    checkFormStatus();

    $("input[required]").on("input", function () {
        checkFormStatus();
    });
});

function checkFormStatus() {
    var allRequiredFilled = true;
    $("input[required]").each(function () {
        if ($(this).val() === "") {
            allRequiredFilled = false;
            return false;
        }
    });

    if (allRequiredFilled) {
        $(":submit").removeAttr("disabled");
    } else {
        $(":submit").attr("disabled", "disabled");
    }
}