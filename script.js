document.querySelectorAll('.category-btn').forEach(button => {
    button.addEventListener('click', function() {
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });

        this.classList.add('active');
    });
});

document.querySelector('form').addEventListener('submit', function(e) {
    let valid = true;

    // Validar nome
    const nome = document.getElementById('name');
    if (nome.value.trim() === '') {
        alert('Por favor, preencha seu nome.');
        valid = false;
    }

    // Validar e-mail
    const email = document.getElementById('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email.value)) {
        alert('Por favor, insira um e-mail válido.');
        valid = false;
    }

    // Validar mensagem
    const mensagem = document.getElementById('message');
    if (mensagem.value.trim() === '') {
        alert('Por favor, escreva sua mensagem.');
        valid = false;
    }

    if (!valid) {
        e.preventDefault();
    }
});

// Verificar parâmetros da URL para mostrar mensagens
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'sucesso') {
        alert('Mensagem enviada com sucesso! Entraremos em contato em breve.');
    } else if (status === 'erro') {
        alert('Ocorreu um erro ao enviar sua mensagem. Tente novamente mais tarde.');
    } else if (status === 'erro_validacao') {
        alert('Por favor, preencha todos os campos obrigatórios corretamente.');
    }
});