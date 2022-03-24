import React, { useState } from "react";
import Modal from "react-bootstrap/Modal";
import dayjs from "dayjs";

const ListItem = ({ campaign }) => {
    const [showModal, setShowModal] = useState(false);
    const handleModal = () => setShowModal(!showModal);

    return (
        <tr className="text-center">
            <th scope="row">{campaign.id}</th>
            <th>{campaign.name}</th>
            <th>
                {campaign?.from_date
                    ? dayjs(campaign?.from_date).format("DD-MMM-YYYY")
                    : ""}
            </th>
            <th>
                {campaign?.to_date
                    ? dayjs(campaign?.to_date).format("DD-MMM-YYYY")
                    : ""}
            </th>
            <th>${campaign.total_budget}</th>
            <th>${campaign.daily_budget}</th>
            <th>
                <a
                    href={`/campaigns/${campaign.id}/edit`}
                    className="btn btn-sm btn-primary me-2"
                >
                    Edit
                </a>
                <a
                    href="#"
                    onClick={handleModal}
                    className="btn btn-sm btn-success me-2"
                >
                    Preview
                </a>
            </th>
            <Modal size="lg" show={showModal} onHide={handleModal}>
                <Modal.Header closeButton>
                    <Modal.Title>{campaign?.name}</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <div class="d-flex">
                        <div className="row">
                            <div className="col-md-12">
                                <p>
                                    <span className="fw-bold">From Date: </span>
                                    <span>
                                        {campaign?.from_date
                                            ? dayjs(campaign?.from_date).format(
                                                  "DD-MMM-YYYY"
                                              )
                                            : ""}
                                    </span>
                                </p>
                                <p>
                                    <span className="fw-bold">To Date: </span>
                                    <span>
                                        {campaign?.to_date
                                            ? dayjs(campaign?.to_date).format(
                                                  "DD-MMM-YYYY"
                                              )
                                            : ""}
                                    </span>
                                </p>
                                <p>
                                    <span className="fw-bold">
                                        Total Budget ($):
                                    </span>
                                    <span>
                                        {campaign?.total_budget
                                            ? `$ ${campaign?.total_budget}`
                                            : 0}
                                    </span>
                                </p>
                                <p>
                                    <span className="fw-bold">
                                        Daily Budget ($):
                                    </span>
                                    <span>
                                        {campaign?.daily_budget
                                            ? `$ ${campaign?.daily_budget}`
                                            : 0}
                                    </span>
                                </p>
                            </div>
                            {campaign?.creative_upload.map((item, index) => (
                                <div key={index} className="col-md-4 mb-3">
                                    <img
                                        src={item.path}
                                        className="img-fluid border border-info rounded-4"
                                        alt={item.file_name}
                                        style={{ height: "300px" }}
                                    />
                                </div>
                            ))}
                        </div>
                    </div>
                </Modal.Body>
            </Modal>
        </tr>
    );
};

export default ListItem;
