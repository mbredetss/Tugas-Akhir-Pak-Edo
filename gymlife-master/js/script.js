document.getElementById('btnProfile').addEventListener('click', function (event) {
    event.preventDefault();
    const option = document.getElementById('listOption')
    option.removeAttribute('hidden');
});