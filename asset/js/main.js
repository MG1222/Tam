import {dropDown} from "../js/dropDown.js";
import {switchLogo} from "../js/logoswitch.js";
import {iconSwitch, showHint} from "../js/user.js";

const main = () => {
    dropDown();
    switchLogo();
    iconSwitch();
    showHint();
    errorClick();



}

const errorClick = () => {
    const errorDiv = document.querySelectorAll('.errors');
    const btn = document.querySelectorAll('.like-btn');

    console.log(btn);
    console.log(errorDiv);
    if (errorDiv !== null) {

        errorDiv.forEach(() => {

            btn.forEach(() => {
                for (let i = 0; i < btn.length; i++) {
                    btn[i].addEventListener('click', () => {
                            errorDiv[i].style.display = 'none';
                        }
                    )

                }
            })
        });

    }
    else {
        console.log('error not found');
    }
}







addEventListener('DOMContentLoaded', main);







