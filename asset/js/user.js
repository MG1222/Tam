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
        const hint = document.querySelector('.hint');
        hint.classList.add('show');
    }
    , 1000);
}

export const hideHint = () => {
    setTimeout(() => {
        const hint = document.querySelector('.hint');
        hint.classList.remove('show');
    }
    , 4000);
}