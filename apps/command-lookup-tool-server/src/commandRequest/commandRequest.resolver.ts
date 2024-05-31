import * as graphql from "@nestjs/graphql";
import { CommandRequestResolverBase } from "./base/commandRequest.resolver.base";
import { CommandRequest } from "./base/CommandRequest";
import { CommandRequestService } from "./commandRequest.service";

@graphql.Resolver(() => CommandRequest)
export class CommandRequestResolver extends CommandRequestResolverBase {
  constructor(protected readonly service: CommandRequestService) {
    super(service);
  }
}
