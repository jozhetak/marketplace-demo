import React from 'react';
import { connect } from 'react-redux';
import { withRouter } from "react-router-dom";
import { logOut } from "../actions/authentication";

const logoutMessageStyle = {
    minHeight: '360px'
}

class LogoutComponent extends React.Component{

    state = {
        logoutMessage: "Please wait while we safely log you out..."
    };

    componentDidMount() {
        if (this.props.authentication.isAuthenticated) {
            this.props.dispatch(logOut());
        }

        this.props.history.push("/login");
    }

    render() {
        return (
            <div style={logoutMessageStyle} className={"padding-2xl"} ref={"logout-div"}>
                <h3>{this.state.logoutMessage}</h3>
            </div>
        )
    }
}

const mapStateToProps = (state) => {
    return {
        authentication: state.authentication
    };
};

export default connect(mapStateToProps)(withRouter(LogoutComponent));
