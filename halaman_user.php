// Contoh cara mengambil data di Front-end menggunakan API
fetch('api_menu.php', {
    method: 'GET',
    headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') }
})
.then(response => response.json())
.then(result => {
    if(result.status === 200) {
        // Tampilkan data ke HTML secara dinamis menggunakan JavaScript
        console.log(result.data);
    }
})
.catch(error => console.error('Error:', error));