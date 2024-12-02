    Hey,

    Sebuah item telah keluar dari ruangan. Berikut adalah detailnya:

    <table>
        <tr><td>Nama:</td><td><strong>{{ $itemMovement->tag->tagMap->inventory->KETER }}</strong></td></tr>
        <tr><td>Kode Barang:</td><td><strong>{{ $itemMovement->tag->tagMap->inventory->ACC }}</strong></td></tr>
        <tr><td>Tag:</td><td><strong>{{ $itemMovement->tag->tag }}</strong></td></tr>
        <tr><td>Lokasi:</td><td><strong>{{ $itemMovement->room->name }}</strong></td></tr>
        <tr><td>Waktu:</td><td><strong>{{ $itemMovement->created_at }}</strong></td></tr>
    </table>

    Pesan otomatis
    [SSR]