import React from "react";

const DateInput = ({
    label,
    onChange,
    required = true,
    value,
    fullWidth = true,
}) => {
    return (
        <div className={`mb-3 ${!fullWidth ? "col-md-6" : ""}`}>
            <label className="form-label">{label}</label>
            <input
                type="date"
                value={value}
                onChange={onChange}
                className="form-control"
                required={required}
            />
        </div>
    );
};

export default DateInput;
