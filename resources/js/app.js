import './bootstrap';
import Swal from 'sweetalert2';
function hideAlert(elementId) {
    const alertElement = document.getElementById(elementId);
    if (alertElement) {
        setTimeout(() => {
             alertElement.remove();
        }, 3000);
    }
}
hideAlert('alert-success');
hideAlert('alert-error');
hideAlert('alert-validation');


document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = event.target.closest('form');
            if (!form) {
                console.error('Tombol delete tidak berada di dalam form.');
                return;
            }

            Swal.fire({
                title: "Apakah Anda yakin?",        
                text: "Data yang dihapus tidak dapat dikembalikan!", 
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6", 
                cancelButtonColor: "#d33",    
                confirmButtonText: "Ya, hapus!", 
                cancelButtonText: "Batal"       
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.logout-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = event.target.closest('form');
            if (!form) {
                console.error('Tombol delete tidak berada di dalam form.');
                return;
            }

            Swal.fire({
                title: "Apakah Anda yakin?",        
                text: "Setelah logout anda harus login kembali untuk melanjutkan!", 
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6", 
                cancelButtonColor: "#d33",    
                confirmButtonText: "Ya, logout!", 
                cancelButtonText: "Batal"       
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});