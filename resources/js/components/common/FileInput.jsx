import React from "react";

const FileInput = ({ fileCount, onChange }) => {
    return [...Array(fileCount)].map((val, key) => (
        <div className="row mb-3" key={key}>
            <div className="col-12">
                <input
                    type="file"
                    onChange={onChange}
                    className="form-control"
                />
            </div>
        </div>
    ));
};

export default FileInput;
