/* see the image inserted */
const inputFile = document.querySelector("#picture__input");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = "Imagem principal do produto";
pictureImage.innerHTML = pictureImageTxt;

inputFile.addEventListener("change", function (e) {
  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      const img = document.createElement("img");
      img.src = readerTarget.result;
      img.classList.add("picture__img");
      pictureImage.innerHTML = "";
      pictureImage.appendChild(img);
    });

    reader.readAsDataURL(file);
  } else {
    pictureImage.innerHTML = pictureImageTxt;
  }
});

/* see the storage manager */

const manageStorageCheckbox = document.getElementById('manage-storage');
    const storageContainer = document.getElementById('storage-container');

    manageStorageCheckbox.addEventListener('change', function() {
        if (manageStorageCheckbox.checked) {
            storageContainer.style.display = 'block';
        } else {
            storageContainer.style.display = 'none';
        }
    });

    /* add variations of products */

    const manageVariableCheckbox = document.getElementById('manage-variable');
    const variableContainer = document.getElementById('variable-container');

    manageVariableCheckbox.addEventListener('change', function() {
        if (manageVariableCheckbox.checked) {
          variableContainer.style.display = 'block';
        } else {      
          variableContainer.style.display = 'none';
        }
    });
    const addVariableSelectLink = document.getElementById('add-variable-select-link');
    const variableSelectContainer = document.getElementById('variable-select-container');

    addVariableSelectLink.addEventListener('click', function(event) {
        event.preventDefault(); // Impede o comportamento padrão do link

        // Criar label
        const label = document.createElement('label');
        label.setAttribute('for', 'variable-select');
        label.textContent = 'Seleção para essa opção:';
        variableSelectContainer.appendChild(label);

        // Criar input
        const input = document.createElement('input');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'variable-select');
        input.setAttribute('id', 'variable-select');
        input.setAttribute('placeholder', 'Tipo de produto');
        variableSelectContainer.appendChild(input);
    });
     // Function to format the input value as currency
     function formatCurrency(input) {
      // Remove non-numeric characters from input
      let value = input.value.replace(/\D/g, '');
      
      // Format the value as currency
      value = (value / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      
      // Update the input value
      input.value = value;
  }
  
  // Get the price input element
  const priceInput = document.getElementById('price');
  
  // Add an event listener for input event
  priceInput.addEventListener('input', function() {
      // Call the formatCurrency function when the user types
      formatCurrency(this);
  });