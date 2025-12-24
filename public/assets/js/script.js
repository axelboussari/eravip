document.addEventListener('DOMContentLoaded', function () {
    
    const form = document.querySelector('.equipement-form');
    
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(() => alert.style.display = 'none', 500); 
        });
    }, 5000);

    const closebtns = document.querySelectorAll('.closebtn');
    closebtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const alert = btn.closest('.alert');
            if (alert) {
                 alert.style.display = 'none';
            }
        });
    });

    window.displayFilename = function(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Aucun fichier sélectionné';
        console.log("Fichier sélectionné : " + fileName);
    };

    if (form) {
        form.addEventListener('submit', function() {
            const btn = document.getElementById('addBtn');
            const icon = document.getElementById('icon');
            const spinner = document.getElementById('spinner');
            const btnText = document.getElementById('btnText');

            if (btn) btn.disabled = true;
            if (icon) icon.classList.add('d-none');
            if (spinner) spinner.classList.remove('d-none');
            if (btnText) btnText.textContent = ' Enregistrement en cours...';
        });
    }

    const container = document.getElementById('equipements-container');
    const addBtn = document.getElementById('addEquipementBtn');
    
    if (container && addBtn) {
        let equipementIndex = container.querySelectorAll('.equipement-item').length;

        function renameFields(el, index, isClone = false) {
            el.querySelectorAll('input, textarea, select').forEach(function(field) {
                const name = field.getAttribute('name');
                if (!name) return;
                
                const newName = name.replace(/\[\d+\]/g, '[' + index + ']');
                field.setAttribute('name', newName);

                if (isClone) {
                    if (field.tagName === 'SELECT') {
                        field.selectedIndex = 0;
                    } else {
                        field.value = '';
                    }
                }
            });
        }

        function addEquipement() {
            const prototype = container.querySelector('.equipement-item');
            if (!prototype) return;
            
            const clone = prototype.cloneNode(true);
            clone.setAttribute('data-index', equipementIndex);
            
            const itemNumber = clone.querySelector('.item-number');
            if (itemNumber) itemNumber.textContent = equipementIndex + 1;

            const removeBtn = clone.querySelector('.btn-remove');
            if (removeBtn) {
                removeBtn.style.display = 'inline-block';
                removeBtn.removeAttribute('onclick'); 
            }

            renameFields(clone, equipementIndex, true); 

            container.appendChild(clone);
            equipementIndex++;

            clone.scrollIntoView({ behavior: 'smooth', block: 'start' });

            updateRemoveButtons();
        }

        function removeEquipementElement(item) {
            if (container.querySelectorAll('.equipement-item').length > 1) {
                 item.remove();
            } else {
                 return; 
            }

            const items = container.querySelectorAll('.equipement-item');
            items.forEach((it, idx) => {
                it.setAttribute('data-index', idx);
                const itemNumber = it.querySelector('.item-number');
                if (itemNumber) itemNumber.textContent = idx + 1;
                renameFields(it, idx, false);
            });

            equipementIndex = items.length;
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const items = container.querySelectorAll('.equipement-item');
            items.forEach(function(item) {
                const removeBtn = item.querySelector('.btn-remove');
                if (!removeBtn) return;
                removeBtn.style.display = (items.length > 1) ? 'inline-block' : 'none';
            });
        }

        addBtn.addEventListener('click', addEquipement);

        container.addEventListener('click', function(e) {
            const target = e.target;
            const removeBtn = target.closest('.btn-remove');
            if (removeBtn) {
                const item = removeBtn.closest('.equipement-item');
                if (item) removeEquipementElement(item);
            }
        });

        updateRemoveButtons();
    }
});