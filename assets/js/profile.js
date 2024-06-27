function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('profile_image_preview');
    const reader = new FileReader();
    reader.onload = function() {
        preview.src = reader.result;
        preview.classList.remove('hidden');
    };
    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}

function toggleEditForm() {
    document.getElementById('profileCard').classList.toggle('hidden');
    document.getElementById('editCard').classList.toggle('hidden');
}

function togglePasswordForm() {
    const overlay = document.getElementById('passwordOverlay');
    if (overlay.classList.contains('hidden')) {
        overlay.style.display = 'flex';
        overlay.classList.remove('hidden');
    } else {
        overlay.style.display = 'none';
        overlay.classList.add('hidden');
    }
}