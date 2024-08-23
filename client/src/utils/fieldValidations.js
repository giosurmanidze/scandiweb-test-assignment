const validateForm = (errors, form) => {
    let isValid = true;
    Object.keys(errors.value).forEach((key) => (errors.value[key] = false)); // Reset errors

    if (!form.value.sku) {
        errors.value.sku = true;
        isValid = false;
    }
    if (!form.value.name) {
        errors.value.name = true;
        isValid = false;
    }
    if (!form.value.price) {
        errors.value.price = true;
        isValid = false;
    } else if (isNaN(Number(form.value.price))) {
        errors.value.price = true;
        isValid = false;
    }

    if (form.value.type === 'book' && (!form.value.weight || isNaN(Number(form.value.weight)))) {
        errors.value.weight = true;
        isValid = false;
    }

    if (form.value.type === 'dvd' && (!form.value.size || isNaN(Number(form.value.size)))) {
        errors.value.size = true;
        isValid = false;
    }

    if (form.value.type === 'furniture') {
        if (!form.value.width || isNaN(Number(form.value.width))) {
            errors.value.width = true;
            isValid = false;
        }
        if (!form.value.height || isNaN(Number(form.value.height))) {
            errors.value.height = true;
            isValid = false;
        }
        if (!form.value.length || isNaN(Number(form.value.length))) {
            errors.value.length = true;
            isValid = false;
        }
    }

    return isValid;
};

export default validateForm;