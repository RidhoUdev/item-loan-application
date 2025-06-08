import "./bootstrap";
import Swal from "sweetalert2";
function hideAlert(elementId) {
    const alertElement = document.getElementById(elementId);
    if (alertElement) {
        setTimeout(() => {
            alertElement.remove();
        }, 3000);
    }
}
hideAlert("alert-success");
hideAlert("alert-error");
hideAlert("alert-validation");

document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const form = event.target.closest("form");
            if (!form) {
                console.error("Tombol delete tidak berada di dalam form.");
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
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".cancel-button");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const form = event.target.closest("form");

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Setelah dibatalkan pesanan tidak akan diproses!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, batalkan!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".logout-button");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const form = event.target.closest("form");
            if (!form) {
                console.error("Tombol delete tidak berada di dalam form.");
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
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById("image_input");
    const imagePreview = document.getElementById("image_preview");
    const placeholderPreview = document.getElementById("placeholder_preview");
    const resetImageButton = document.getElementById("reset_image_button");

    function resetPreview() {
        imageInput.value = "";
        imagePreview.classList.add("hidden");
        imagePreview.src = "#";
        placeholderPreview.classList.remove("hidden");
        resetImageButton.classList.add("hidden");
    }

    if (imageInput) {
        imageInput.addEventListener("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove("hidden");
                    resetImageButton.classList.remove("hidden");
                    placeholderPreview.classList.add("hidden");
                };
                reader.readAsDataURL(file);
            } else {
                resetPreview();
            }
        });
    }

    if (resetImageButton) {
        resetImageButton.addEventListener("click", function () {
            resetPreview();
        });
    }

    const createItemForm = document.getElementById("create_item_form_content");
    if (createItemForm) {
        createItemForm.addEventListener("reset", function () {
            setTimeout(resetPreview, 50);
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const editPreviewWrappers = document.querySelectorAll(
        ".image-preview-wrapper"
    );

    editPreviewWrappers.forEach((wrapper) => {
        const itemId = wrapper.dataset.itemId;

        const imageInput = document.getElementById(`image_input_${itemId}`);
        const imagePreview = document.getElementById(`image_preview_${itemId}`);
        const placeholderPreview = document.getElementById(
            `placeholder_preview_${itemId}`
        );
        const resetImageButton = document.getElementById(
            `reset_image_button_${itemId}`
        );

        function resetToOriginal() {
            imageInput.value = "";
            const originalSrc = imagePreview.dataset.originalSrc;

            if (originalSrc) {
                imagePreview.src = originalSrc;
                imagePreview.classList.remove("hidden");
                resetImageButton.classList.remove("hidden");
                placeholderPreview.classList.add("hidden");
            } else {
                imagePreview.classList.add("hidden");
                imagePreview.src = "#";
                resetImageButton.classList.add("hidden");
                placeholderPreview.classList.remove("hidden");
            }
        }

        if (imageInput) {
            imageInput.addEventListener("change", function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.classList.remove("hidden");
                        resetImageButton.classList.remove("hidden");
                        placeholderPreview.classList.add("hidden");
                    };
                    reader.readAsDataURL(file);
                } else {
                    resetToOriginal();
                }
            });
        }

        if (resetImageButton) {
            resetImageButton.addEventListener("click", function () {
                resetToOriginal();
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("adminSidebar");
    const sidebarToggleBtn = document.getElementById("adminSidebarToggle");
    const iconHamburger = document.getElementById("iconHamburger");
    const iconClose = document.getElementById("iconClose");
    const sidebarBackdrop = document.getElementById("sidebarBackdrop");
    let isSidebarMobileOpen = false;

    function toggleMobileSidebar() {
        isSidebarMobileOpen = !isSidebarMobileOpen;
        if (isSidebarMobileOpen) {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            sidebarBackdrop.classList.remove("hidden");
            if (iconHamburger && iconClose) {
                iconHamburger.classList.add("hidden");
                iconClose.classList.remove("hidden");
            }
            document.body.classList.add("overflow-hidden", "lg:overflow-auto");
        } else {
            sidebar.classList.add("-translate-x-full");
            sidebar.classList.remove("translate-x-0");
            sidebarBackdrop.classList.add("hidden");
            if (iconHamburger && iconClose) {
                iconHamburger.classList.remove("hidden");
                iconClose.classList.add("hidden");
            }
            document.body.classList.remove(
                "overflow-hidden",
                "lg:overflow-auto"
            );
        }
    }

    if (sidebarToggleBtn && sidebar && sidebarBackdrop) {
        sidebarToggleBtn.addEventListener("click", function (event) {
            event.stopPropagation();
            toggleMobileSidebar();
        });

        sidebarBackdrop.addEventListener("click", function () {
            if (isSidebarMobileOpen) {
                toggleMobileSidebar();
            }
        });
    }

    window.addEventListener("resize", function () {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            sidebarBackdrop.classList.add("hidden");
            if (iconHamburger && iconClose) {
                iconHamburger.classList.remove("hidden");
                iconClose.classList.add("hidden");
            }
            isSidebarMobileOpen = false;
            document.body.classList.remove("overflow-hidden");
            document.body.classList.add("lg:overflow-auto");
        } else {
            if (!isSidebarMobileOpen) {
                sidebar.classList.add("-translate-x-full");
                sidebar.classList.remove("translate-x-0");
            }
            if (!isSidebarMobileOpen) {
                document.body.classList.remove("lg:overflow-auto");
            }
        }
    });

    if (window.innerWidth < 1024 && sidebar) {
        sidebar.classList.add("-translate-x-full");
        sidebar.classList.remove("translate-x-0");
    } else if (sidebar) {
        sidebar.classList.remove("-translate-x-full");
        sidebar.classList.add("translate-x-0");
    }

    function hideAlert(elementId) {
        const alertElement = document.getElementById(elementId);
        if (alertElement) {
            setTimeout(() => {
                alertElement.remove();
            }, 3000);
        }
    }
    hideAlert("alert-success");
    hideAlert("alert-error");
    hideAlert("alert-validation");

    const deleteButtons = document.querySelectorAll(".delete-button");
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const form = event.target.closest("form");
            if (!form) return;

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

function updateNavbarNotifications(newNotification = null) {
    const badgeElement = document.getElementById("navbarNotificationBadge");
    const notificationListElement = document.getElementById("notificationList");

    if (badgeElement) {
        let currentCount = parseInt(badgeElement.innerText) || 0;
        if (newNotification) {
            currentCount++;
        }
        badgeElement.innerText = currentCount;
        if (currentCount > 0) {
            badgeElement.classList.remove("hidden");
        } else {
            badgeElement.classList.add("hidden");
        }
    }

    if (newNotification && notificationListElement) {
        const listItem = document.createElement("li");
        listItem.className = "bg-base-200 font-semibold";

        const link = document.createElement("a");
        link.href = newNotification.url || "#";
        link.className = "notification-link whitespace-normal py-3 block";

        const flexDiv = document.createElement("div");
        flexDiv.className = "flex flex-col";

        const messageP = document.createElement("p");
        messageP.className = "text-xs text-base-content/70";
        messageP.innerText = newNotification.body || "Notifikasi baru.";
        if (newNotification.item_name) {
            const itemSpan = document.createElement("span");
            itemSpan.className = "font-normal";
            itemSpan.innerText = ` (${newNotification.item_name})`;
            messageP.appendChild(itemSpan);
        }

        const timeSpan = document.createElement("span");
        timeSpan.className = "text-xs text-base-content/50 mt-1";
        timeSpan.innerText = "Baru saja";

        flexDiv.appendChild(messageP);
        flexDiv.appendChild(timeSpan);
        link.appendChild(flexDiv);
        listItem.appendChild(link);

        const noNotifMessage =
            notificationListElement.querySelector(".text-center");
        if (noNotifMessage) {
            noNotifMessage.parentElement.remove();
        }

        notificationListElement.prepend(listItem);

        while (notificationListElement.children.length > 5) {
            notificationListElement.removeChild(
                notificationListElement.lastChild
            );
        }
    }
}

// Letakkan kode ini di dalam file js/app.js Anda

document.addEventListener('DOMContentLoaded', function () {

    const reminderButtons = document.querySelectorAll('.send-reminder-btn');
    reminderButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const formId = this.dataset.formId;
            const borrowerName = this.dataset.borrowerName;
            const form = document.getElementById(formId);

            if (!form) {
                console.error('Form not found for this button:', this);
                return;
            }
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-info text-white ml-2",
                    cancelButton: "btn btn-ghost"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Anda Yakin?",
                text: `Kirim notifikasi pengingat ke "${borrowerName}"?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Ya, Kirim!",
                cancelButtonText: "Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
