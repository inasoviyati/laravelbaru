const req = $('input[required], select[required]')
const form = $('form')

if (req.length) {
    req.parent().find('label').append('<span class="text-danger ms-1">*</span>')
    $('* div.form-group:last').after('<div class="mb-4 w-100 text-muted"><span class="text-danger ms-1">*</span>) Wajib diisi</div>')
}

if (form) {
    form.attr('autocomplete', 'off')
}

$('button[class*="btn-danger"]:submit:contains("Hapus")').attr('onclick', "return confirm('Yakin akan menghapus data ini?')")
