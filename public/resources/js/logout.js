// harus hati hati, sertakan .js nya, errronya gaakan keliatan, bikin pusing
import { showConfirm, showAlertDanger } from "./utility/alert.js";

const appurl = document.querySelector("meta[name=_appurl]").content;
const token = document.querySelector("meta[name=_token]").content;
let btnLogout = document.getElementById("btnLogout");


async function logout(e) {
    e.preventDefault();
    await showConfirm("Anda yakin ingin logout?", "question", "Iya").then(async (result) => {
        if (result.isConfirmed) {
            try {
                let data = await fetch("/admin/logout", {
                    method: "POST",
                    headers: {
                        "content-type": "application/json",
                        "X-CSRF-TOKEN": token
                    },
                    body: {}
                });
                let response = await data.json();
                if (!data.ok) {
                    throw new Error("HTTP ERROR", data.status);
                }
                if (data.status === 200) {
                    document.location.href = response.redirect_url;
                }
            } catch (error) {
                await showAlertDanger(error);
            }

        }
    });
}

if(btnLogout != null)
    btnLogout.addEventListener("click", logout);
