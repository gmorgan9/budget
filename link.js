function switchVisible() {
    if (document.getElementById('deleted')) {

        if (document.getElementById('deleted').style.display == 'none') {
            document.getElementById('deleted').style.display = 'block';
            document.getElementById('trans').style.display = 'none';
        }
        else {
            document.getElementById('deleted').style.display = 'none';
            document.getElementById('trans').style.display = 'block';
        }
    }
}