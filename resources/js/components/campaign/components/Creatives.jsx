import React from "react";

const Creatives = ({ creativeUploads }) => {
    return (
        creativeUploads?.length > 0 && (
            <div className="row">
                <div className="col-md-12">
                    <h3>Creatives</h3>
                </div>
                {creativeUploads.map((element, index) => (
                    <div key={index} className="col-md-4 mb-3">
                        <img
                            src={element.path}
                            className="img-fluid border border-info rounded-4"
                            alt={element.file_name}
                            style={{ height: "300px" }}
                        />
                    </div>
                ))}
            </div>
        )
    );
};

export default Creatives;
