import React from "react";
import { Grid, Row, Col, Glyphicon } from "react-bootstrap";
import OrderList from "../components/OrderList";
import ScrollToTop from "react-scroll-up";

const MyOrders = () => (
    <Grid className="page-min-height margin-b-2xl">
        <ScrollToTop showUnder={110} style={{ bottom: 80 }}>
            <div className="text-center">
                <Glyphicon glyph="arrow-up"/>
                <p>Back to Top</p>
            </div>
        </ScrollToTop>
        <Row>
            <Col lg={10} md={10} lgOffset={1} mdOffset={1}>
                <OrderList/>
            </Col>
        </Row>
    </Grid>
);

export default MyOrders;
