export const iconSwitch = () => {
    const icon = document.querySelector('.fa-eye');
    const input = document.querySelector('.password');
    if (icon !== null) {

        icon.addEventListener('click', () => {


           if (icon.classList.contains('fa-eye')) {

                  icon.classList.remove('fa-eye');
                  icon.classList.add('fa-eye-slash');
                  input.type = 'text';
            }
             else {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    input.type = 'password';
                 }

            });

    }
    else {
        console.log('icon not found');
    }
}

export const showHint = () => {
    const input = document.querySelector('.password');
    if (input !== null) {

        setTimeout(() => {
                input.placeholder = 'en moins de 8 caractères';

            }
            , 1000);

        setTimeout(() => {
            input.placeholder = 'mot de passe';
        }, 4000);
    }
    else {
        console.log('input not found');
    }
}

