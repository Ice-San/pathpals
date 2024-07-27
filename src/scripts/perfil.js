function updateProfileText(inputId, paragraphId, initialValue) {
    const input = document.getElementById(inputId);
    const paragraph = document.getElementById(paragraphId);
    input.addEventListener('input', function() {
        if (this.value === '') {
            paragraph.textContent = initialValue;
        } else {
            paragraph.textContent = this.value;
        }
    });
}

const initialUsernameText = document.getElementById('perfil-username-text').textContent;
const initialNameText = document.getElementById('perfil-name-text').textContent;
const initialApelidoText = document.getElementById('perfil-apelido-text').textContent;
const initialCareerText = document.getElementById('perfil-career-text').textContent;
const initialClassText = document.getElementById('perfil-class-text').textContent;
const initialSobremimText = document.getElementById('perfil-sobremim-text').textContent;

updateProfileText('input-username', 'perfil-username-text', initialUsernameText);
updateProfileText('input-name', 'perfil-name-text', initialNameText);
updateProfileText('input-apelido', 'perfil-apelido-text', initialApelidoText);
updateProfileText('input-career', 'perfil-career-text', initialCareerText);
updateProfileText('input-class', 'perfil-class-text', initialClassText);
updateProfileText('input-sobremim', 'perfil-sobremim-text', initialSobremimText);
