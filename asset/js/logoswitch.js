export const  switchLogo = () => {
const logo = document.querySelector('.logo');

    logo.addEventListener('mouseover', () => {
        if (logo.src.match('2.svg')) {
            logo.src = '/projet/asset/img/site/1.svg';
        }
        else {
            logo.src = '/projet//asset/img/site/2.svg';
        }


    });
}