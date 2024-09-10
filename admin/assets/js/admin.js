function signIn() {
    const email = document.getElementById("email").value;
    const pass = document.getElementById("pass").value;

    const form = new FormData();
    form.append("email", email);
    form.append("pass", pass);

    const req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "success") {
                window.location = "index.php";
            } else {
                document.getElementById("login-btn").classList.remove("active")
                document.getElementById("formErr").innerHTML = txt;
            }
        }
    };
    req.open('post', 'process/admin-sign-in-process.php', true);
    req.send(form);
}

function forgotPassword() {
    const email = document.getElementById("fpemail");

    const form = new FormData();
    form.append("email", email.value);

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            console.log(req.responseText);
            if (req.responseText === "Verification email sent") {
                document.getElementById("formErr").innerHTML = "";
                document.getElementById("login-btn").setAttribute("disabled", "true");
                document.getElementById("login-btn").innerHTML = "Email sent to your inbox";
                setTimeout(() => {
                    window.location.reload();
                }, 5000);
            } else {
                document.getElementById("login-btn").classList.remove("active")
                document.getElementById("formErr").innerHTML = req.responseText;
            }
        }
    }
    req.open("post", "process/send-admin-forgot-pwd-email-process.php", true);
    req.send(form);
}

function resetFpPassword(code) {
    let newPass = document.getElementById("npass");
    let confirmPass = document.getElementById("cpass");

    let form = new FormData();
    form.append("code", code);
    form.append("newPass", newPass.value);
    form.append("confirmPass", confirmPass.value);

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            console.log(req.responseText);
        }
    }
    req.open("post", "process/reset-admin-forgot-pwd-process.php", true);
    req.send(form);
}

function searchUsers() {
    let userSearchTxt = document.getElementById("userSearchText");

    let form = new FormData();
    form.append("userSearchTxt", userSearchTxt.value);

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("searchResults").innerHTML = req.responseText;
        }
    }
    req.open("post", "process/search-users-process.php", true);
    req.send(form);
}

function showProductaUpdateModal(pid) {
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let json = JSON.parse(req.responseText);

            document.getElementById("pid").value = json["productDetails"].pid;
            document.getElementById("ptitle").value = json["productDetails"].title;
            document.getElementById("pprice").value = json["productDetails"].price;
            document.getElementById("pdesc").value = json["productDetails"].description;
            document.getElementById("pqty").value = json["productDetails"].qty;
            document.getElementById("pdesc").value = json["productDetails"].description;
            document.getElementById("pcategory").value = json["productDetails"].category_id;
            document.getElementById("pbrand").value = json["productDetails"].brand_id;
            document.getElementById("punit").value = json["productDetails"].unit_id;

            if (json["productImages"]) {
                let container = document.getElementById("productImgContainer");
                container.innerHTML = "";
                for (let i = 0; i < json["productImages"].length; i++) {
                    let imageTag = document.createElement("img");
                    imageTag.style.width = "130px";
                    imageTag.src = "../../" + json["productImages"][i].code;

                    container.append(imageTag);
                }
            } else {
                let imageTag = document.createElement("img");
                imageTag.style.width = "130px";
                imageTag.src = "assets/images/image_icon.png";

                let container = document.getElementById("productImgContainer");
                container.innerHTML = "";
                container.append(imageTag);
            }


            let modal = new bootstrap.Modal(document.getElementById("updateProduct"));
            modal.show();
        }
    }
    req.open("get", "process/load-product-details.php?product=" + pid, true);
    req.send();
}

function selectProductImages() {
    let files = document.getElementById("productImgInput").files;
    let container = document.getElementById("productImgContainer");

    container.innerHTML = "";
    for (let i = 0; i < files.length; i++) {
        let reader = new FileReader();
        reader.readAsDataURL(files[i]);
        reader.onload = (e) => {
            let imageTag = document.createElement("img");
            imageTag.style.width = "130px";
            imageTag.src = e.target.result;

            container.append(imageTag);
        }
    }
}

function clearSelectedImages() {
    let pid = document.getElementById("pid").value;
    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let json = JSON.parse(req.responseText);

            let container = document.getElementById("productImgContainer");
            container.innerHTML = "";
            if (json.productImages.length != 0) {
                json.productImages.forEach(e => {
                    let imageTag = document.createElement("img");
                    1
                    imageTag.style.width = "130px";
                    imageTag.src = "../../" + e.code;
                    container.append(imageTag);
                })
            } else {
                document.getElementById("productImgInput").value = "";
                let imageTag = document.createElement("img");
                imageTag.style.width = "130px";
                imageTag.src = "assets/images/image_icon.png";
                container.append(imageTag);
            }
        }
    }
    req.open('get', 'process/clear-product-images.php?product=' + pid, true);
    req.send();


}

function updateProduct() {
    let pid = document.getElementById("pid").value;
    let title = document.getElementById("ptitle").value;
    let price = document.getElementById("pprice").value;
    let desc = document.getElementById("pdesc").value;
    let qty = document.getElementById("pqty").value;
    let category = document.getElementById("pcategory").value;
    let brand = document.getElementById("pbrand").value;
    let unit = document.getElementById("punit").value;

    let files = document.getElementById("productImgInput").files;

    let form = new FormData();
    form.append("pid", pid);
    form.append("title", title);
    form.append("price", price);
    form.append("desc", desc);
    form.append("qty", qty);
    form.append("category", category);
    form.append("brand", brand);
    form.append("unit", unit);

    for (let i = 0; i < files.length; i++) {
        form.append("files[]", files[i]);
    }

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "Product Updated Successfully") {
                alert(txt);
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open("post", "process/update-product-process.php", true);
    req.send(form);
}

function changedCategory() {
    let category = document.getElementById("pcategory").value;

    let req = new XMLHttpRequest();
    req.onreadystatechange = function () {
        if (req.status === 200 && req.readyState === 4) {
            console.log(req.responseText);
            let json = JSON.parse(req.responseText);

            if (json.error) {
                document.getElementById("pbrand").setAttribute("disabled", "true");
            }

            document.querySelectorAll("#pbrand option").forEach((e) => {
                e.remove();
            });
            let option = document.createElement("option");
            option.value = "0";
            option.innerHTML = "Select Brand";
            document.getElementById("pbrand").append(option);

            for (let i = 0; i < json.length; i++) {
                document.getElementById("pbrand").removeAttribute("disabled");
                let option = document.createElement("option");
                option.value = json[i].id;
                option.innerHTML = json[i].brand;

                document.getElementById("pbrand").append(option);
            }
        }
    }
    req.open("get", "process/load-brands.php?category=" + category, true);
    req.send()
}

function updateProductStatus(pid) {
    let c = confirm("Do you want to update the product status?");

    if (c) {
        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "Product Status Updated Successfully") {
                    alert(txt);
                    window.location.reload();
                } else {
                    alert(txt);
                }
            }
        }
        req.open('get', 'process/update-product-status.php?product=' + pid, true);
        req.send();
    }
}

function loadBrands() {
    let category = document.getElementById("category").value;

    const req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let brands = document.querySelectorAll("#brand option");
            brands.forEach((e) => {
                e.remove();
            })

            let option = document.createElement("option");
            option.value = "0";
            option.setAttribute("disabled", "true");
            option.innerHTML = "Brand Menu";
            document.getElementById("brand").append(option);

            let json = JSON.parse(req.responseText);
            while (json.length != 0) {
                let option = document.createElement("option");
                option.value = json[0].id;
                option.innerHTML = json[0].brand;
                document.getElementById("brand").append(option);
                json.shift();
            }


        }
    }
    req.open('get', 'process/load-brands.php?category=' + category, true);
    req.send();
}

function addProduct(event) {
    event.preventDefault();

    let c = confirm("Do you want to add this product?");

    if (c) {
        let title = document.getElementById("title").value;
        let price = document.getElementById("price").value;
        let desc = document.getElementById("desc").value;
        let qty = document.getElementById("qty").value;
        let category = document.getElementById("category").value;
        let brand = document.getElementById("brand").value;
        let unit = document.getElementById("unit").value;

        let files = document.getElementById("productImages").files;

        let form = new FormData();
        form.append("title", title);
        form.append("price", price);
        form.append("desc", desc);
        form.append("qty", qty);
        form.append("category", category);
        form.append("brand", brand);
        form.append("unit", unit);

        for (let i = 0; i < files.length; i++) {
            form.append("files[]", files[i]);
        }

        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "Product Added Successfully") {
                    alert(txt);
                    window.location.reload();
                } else {
                    alert(txt);
                }
            }
        }
        req.open("post", "process/add-new-product-process.php", true);
        req.send(form);
    }
}

function addNewCategory() {
    let c = confirm("Do you want to add this category?");

    if (c) {
        let category = document.getElementById("newCategory")

        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "Category Added Successfully") {
                    alert(txt);
                    category.value = "";
                } else {
                    alert(txt);
                }
            }
        }
        req.open("get", "process/add-new-category-process.php?category=" + category.value, true);
        req.send();
    }
}

function addNewBrand() {
    let c = confirm("Do you want to add this brand?");

    if (c) {
        let brand = document.getElementById("newBrand")
        let cat = document.getElementById("newBrandCategory");

        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "Brand Added Successfully") {
                    alert(txt);
                    brand.value = "";
                    cat.value = "0";
                } else {
                    alert(txt);
                }
            }
        }
        req.open("get", "process/add-new-brand-process.php?brand=" + brand.value + "&category=" + cat.value, true);
        req.send();
    }
}

function showUpdateCategoryModal(id) {
    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let json = JSON.parse(req.responseText);

            if (json.error) {
                alert(json.error);
            } else {
                document.getElementById("updatedCategory").value = json.category;
                document.getElementById("updatedCategoryId").value = json.id;
                new bootstrap.Modal(document.getElementById("updateCategoryModal")).show();
            }

        }
    }
    req.open("get", "process/load-category.php?category=" + id, true);
    req.send();
}

function updateCategory() {
    let category = document.getElementById("updatedCategory").value;
    let CategoryId = document.getElementById("updatedCategoryId").value;

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "Category Updated Successfully") {
                alert(txt);
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open("get", "process/update-category-process.php?category=" + category + "&id=" + CategoryId, true);
    req.send();
}

function deleteCategory(id) {
    let c = confirm("Do you want to delete this category?");

    if (c) {
        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "Category Deleted Successfully") {
                    alert(txt);
                    window.location.reload();
                } else {
                    alert(txt);
                }
            }
        }
        req.open("get", "process/delete-category-process.php?id=" + id, true);
        req.send();
    }
}

function showUpdatebrandModal(id) {
    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let json = JSON.parse(req.responseText);

            if (json.error) {
                alert(json.error);
            } else {
                document.getElementById("updatedBrand").value = json.brand;
                document.getElementById("updatedBrandId").value = json.id;
                new bootstrap.Modal(document.getElementById("updateBrandModal")).show();
            }

        }
    }
    req.open("get", "process/load-brand-details.php?brand=" + id, true);
    req.send();
}

function updateBrand() {
    let brand = document.getElementById("updatedBrand").value;
    let brandId = document.getElementById("updatedBrandId").value;

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt === "Brand Updated Successfully") {
                alert(txt);
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open("get", "process/update-brand-process.php?brand=" + brand + "&id=" + brandId, true);
    req.send();
}

function deleteBrand(id) {
    let c = confirm("Do you want to delete this brand?");

    if (c) {
        let req = new XMLHttpRequest();
        req.onreadystatechange = () => {
            if (req.readyState === 4 && req.status === 200) {
                let txt = req.responseText;
                if (txt === "Brand Deleted Successfully") {
                    alert(txt);
                    window.location.reload();
                } else {
                    alert(txt);
                }
            }
        }
        req.open("get", "process/delete-brand-process.php?id=" + id, true);
        req.send();
    }
}

function showStatusUpdateModal(invId, status) {
    document.getElementById("invId").value = invId;
    document.getElementById("invStatus").value = status;
    new bootstrap.Modal(document.getElementById("updateOrderStatus")).show();
}

function updateOrderStatus() {
    let invId = document.getElementById("invId").value;
    let status = document.getElementById("invStatus").value;
    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            let txt = req.responseText;
            if (txt == "Invoice status updated") {
                alert(txt);
                window.location.reload();
            } else {
                alert(txt);
            }
        }
    }
    req.open("get", "process/update-order-status-process.php?invId=" + invId + "&status=" + status, true);
    req.send();
}


function searchInvoice(page) {
    let txt = document.getElementById("searchTextInvoice").value;

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("searchResults").innerHTML = req.responseText;
        }
    }

    req.open('get', 'process/search-invoice-process.php?txt=' + txt + "&page=" + page, true);
    req.send();
}

function searchProducts(page) {
    let txt = document.getElementById("searchTextProducts").value;

    let req = new XMLHttpRequest();
    req.onreadystatechange = () => {
        if (req.readyState === 4 && req.status === 200) {
            document.getElementById("searchResults").innerHTML = req.responseText;
        }
    }
    req.open('get', 'process/search-products-process.php?txt=' + txt + "&page=" + page, true);
    req.send();
}