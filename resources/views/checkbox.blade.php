<form method="post">
    @csrf
    <h3>Hobi anda</h3>
    <input id="renang" type="checkbox" name="hobi[]" value="renang">
    <label for="renang">Renang</label>
    <input type="checkbox" id="gaming" name="hobi[]" value="gaming">
    <label for="gaming">Gaming</label>
    <input id="baca" type="checkbox" name="hobi[]" value="baca">
    <label for="baca">Baca</label>
    <br><br>
    <button type="submit">Kirim</button>
</form>