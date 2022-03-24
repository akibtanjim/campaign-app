import React from "react";

const NumberInput = ({
    label,
    onChange,
    value,
    required = true,
    fullWidth = true,
}) => {
    return (
        <div className={`mb-3 ${!fullWidth ? "col-md-6" : ""}`}>
            <label className="form-label">{label}</label>
            <input
                type="number"
                onChange={onChange}
                value={value}
                className="form-control"
                required={required}
            />
        </div>
    );
};

export default NumberInput;
