import React, { Component } from 'react';
import {
  Collapse,
  Navbar,
  NavbarToggler,
  NavbarBrand,
  Nav,
  NavItem,
  Container,
  Button
} from 'reactstrap';


class AppNavbar extends Component {

  constructor(props) {
    super(props);
    this.state = {
      modal: false,
      toTickets:false,
      toReportes:false
    };
  }

  state = {
    isOpen: false
  };

  toggle = () => {
    this.setState({
      isOpen: !this.state.isOpen
    });
  };

  onClickTickets(){
    this.props.pushing.push('/');
  }

  onClickReportes(){
    this.props.pushing.push('/reports');
  }



  render() {

    return (
      <div>
        <Navbar color="dark" dark expand="sm" className="mb-5">
          <Container>
            <NavbarBrand href="/">IT3 Reportes</NavbarBrand>
            <NavbarToggler onClick={this.toggle} />
            <Collapse isOpen={this.state.isOpen} navbar>
              <Nav className="ml-auto" navbar>
                <NavItem>
                  <Button outline color="primary" onClick={()=>this.onClickTickets()}>Tickets</Button>
                </NavItem>
                <NavItem>
                  <Button outline color="primary" onClick={()=>this.onClickReportes()}>Reportes</Button>
                </NavItem>
              </Nav>
            </Collapse>
          </Container>
        </Navbar>
      </div>
    );
  }
}

export default AppNavbar;