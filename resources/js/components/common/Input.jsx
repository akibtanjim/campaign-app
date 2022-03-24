import React from "react";

const Input = ({ label, onChange, value, required = true }) => {
    return (
        <div className="mb-3">
            <label className="form-label">{label}</label>
            <input
                type="text"
                value={value}
                onChange={onChange}
                className="form-control"
                required={required}
            />
        </div>
    );
};

export default Input;
