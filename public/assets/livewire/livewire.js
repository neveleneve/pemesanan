Livewire.on("generateToken", (params) => {
    Swal.fire({
        icon: params[0]['icon'],
        title: params[0]['title'],
        text: params[0]['text'],
    });
});

Livewire.on('restoreMenu', (params) => {
    Swal.fire({
        title: 'Kembalikan Data',
        text: 'Kembalikan data menu ' + params[0].nama + '?',
        showDenyButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        denyButtonText: 'Batalkan',
        customClass: {
            confirmButton: 'btn btn-sm btn-outline-success',
            denyButton: 'btn btn-sm btn-outline-danger',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.createElement('form')
            var token = document.createElement('input');
            var method = document.createElement('input');
            var tokens = document.getElementsByTagName("META")[2].content

            token.setAttribute('type', 'hidden');
            token.setAttribute('name', '_token');
            token.setAttribute('value', tokens)

            method.setAttribute('type', 'hidden');
            method.setAttribute('name', '_method');
            method.setAttribute('value', 'DELETE');

            form.appendChild(token);
            form.appendChild(method);

            form.action = `/menu/restore/` + params[0].id
            form.method = 'POST'
            document.body.appendChild(form);
            form.submit();
        } else if (result.isDenied) {
            Swal.fire('Kamu batal mengembalikan data menu ' + params[0].nama, '', 'info')
        }
    })
})

Livewire.on('restoreMeja', (params) => {
    Swal.fire({
        title: 'Kembalikan Data',
        text: 'Kembalikan data ' + params[0].nama + '?',
        showDenyButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        denyButtonText: 'Batalkan',
        customClass: {
            confirmButton: 'btn btn-sm btn-outline-success',
            denyButton: 'btn btn-sm btn-outline-danger',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.createElement('form')
            var token = document.createElement('input');
            var method = document.createElement('input');
            var tokens = document.getElementsByTagName("META")[2].content

            token.setAttribute('type', 'hidden');
            token.setAttribute('name', '_token');
            token.setAttribute('value', tokens)

            method.setAttribute('type', 'hidden');
            method.setAttribute('name', '_method');
            method.setAttribute('value', 'DELETE');

            form.appendChild(token);
            form.appendChild(method);

            form.action = `/meja/restore/` + params[0].id
            form.method = 'POST'

            document.body.appendChild(form);
            form.submit();
        } else if (result.isDenied) {
            Swal.fire('Kamu batal mengembalikan data ' + params[0], nama, '', 'info')
        }
    })
})
