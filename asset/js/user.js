export const iconSwitch = () => {
    const icon = document.querySelector('.fa-eye');
    const input = document.querySelector('.password');

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

export const showHint = () => {
    setTimeout(() => {
        const input = document.querySelector('.password');
        input.placeholder = 'en moins de 8 caractères';



    }
    , 1000);
    setTimeout(() => {
            const input = document.querySelector('.password');
            input.placeholder = 'mot de passe';
        }
        , 4000);

}

