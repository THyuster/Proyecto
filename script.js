document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();

    var productoID = document.getElementById('searchInput').value;

    fetch('buscar_producto.php?productoID=' + productoID)
        .then(response => response.text())
        .then(data => {
            var productList = document.getElementById('productList');
            productList.innerHTML = data;

        });
});
document.getElementById('addProductForm').addEventListener('submit', function (event) {
    var idproducto = document.getElementsByName('idproducto')[0];
    var productName = document.getElementsByName('productName')[0];
    var productPrice = document.getElementsByName('productPrice')[0];
    var stockActual = document.getElementsByName('stockActual')[0];
    var stockMinimo = document.getElementsByName('stockMinimo')[0];
    var proveedorID = document.getElementsByName('proveedorID')[0];

    if (!idproducto.value || !productName.value || !productPrice.value || !stockActual.value || !stockMinimo.value || !proveedorID.value) {
        alert('Por favor, rellena todos los campos.');
        event.preventDefault();
    }
});
