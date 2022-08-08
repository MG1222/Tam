export const  switchLogo = () => {
const logo = document.querySelector('.logo');
if (logo !== null) {

    logo.addEventListener('mouseover', () => {
        if (logo.src.match('2.svg')) {
            logo.src = '/project/asset/img/site/1.svg';
        } else {
            logo.src = '/project/asset/img/site/2.svg';
        }


    });
}
    else {
        console.log('logo not found');
    }

}