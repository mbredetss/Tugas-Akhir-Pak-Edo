document.addEventListener('click', function (event) {
    if (event.target && event.target.id === 'btnProfile') {
        event.preventDefault();
        const option = document.getElementById('listOption');
        option.removeAttribute('hidden');
        event.target.setAttribute("id", "btnProfiles");
    } else if (event.target && event.target.id === 'btnProfiles') {
        event.preventDefault();
        const option = document.getElementById('listOption');
        option.setAttribute("hidden", true);
        event.target.setAttribute("id", "btnProfile");
    }
});
