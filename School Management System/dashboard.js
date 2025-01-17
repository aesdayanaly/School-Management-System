document.getElementById('aboutTab').addEventListener('click', function(event) {
    event.preventDefault();
    var aboutBox = document.getElementById('aboutBox');
    if (aboutBox.style.display === 'none' || aboutBox.style.display === '') {
        aboutBox.style.display = 'block';
    } else {
        aboutBox.style.display = 'none';
    }
});
document.getElementById('aboutTab').addEventListener('click', function(event) {
    event.preventDefault();
    var aboutBox = document.getElementById('aboutBox1');
    if (aboutBox.style.display === 'none' || aboutBox.style.display === '') {
        aboutBox.style.display = 'block';
    } else {
        aboutBox.style.display = 'none';
    }
});