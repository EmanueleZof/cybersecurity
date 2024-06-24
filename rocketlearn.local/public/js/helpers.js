const validateEmail = (email) => {
    const result = String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    
    if (result != null) {
        return true;
    }
    return false;
};

const validateCode = (code) => {
    const result = code.match(/\d{6}/);
    console.log(result);
    if (result != null) {
        return true;
    }
    return false;
};