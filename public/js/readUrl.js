export default (input, callback, fail = null) => {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = callback

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    } else fail()
}