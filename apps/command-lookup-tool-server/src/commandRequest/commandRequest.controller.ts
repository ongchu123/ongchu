import * as common from "@nestjs/common";
import * as swagger from "@nestjs/swagger";
import { CommandRequestService } from "./commandRequest.service";
import { CommandRequestControllerBase } from "./base/commandRequest.controller.base";

@swagger.ApiTags("commandRequests")
@common.Controller("commandRequests")
export class CommandRequestController extends CommandRequestControllerBase {
  constructor(protected readonly service: CommandRequestService) {
    super(service);
  }
}
